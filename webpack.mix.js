/*
Mix Asset Management
--------------------------------------------------------------------------
|
| Mix provides a clean, fluent API for defining some Webpack build steps
| for your Laravel application. By default, we are compiling the Sass
| file for your application, as well as bundling up your JS files.
|
*/

// Using Laravel Mix in a Standalone project
const { mix } = require('laravel-mix');

// FS library
var fs = require('fs');

// core cms - app.js
mix.js('resources/assets/js/app.js', './public/js');

watchPluginsConfig();
compilePluginChanges();
compileThemesAssets();

/**
 * Get plugins config and create panels into  ./resources/assets/js/plugins-panels.js
 *
 * @param pluginsList array of objects Paths of plugins' config.json
 */
function mapPluginRoutes(pluginsList){
    const getData = new Promise(function(resolve, reject){
        let result = "";
        let promises = [];
        pluginsList.map(function(pluginConfigFile, key){

            let promise = new Promise(function(resolveThis, reject) {
                fs.readFile(pluginConfigFile, (err, data) => {
                    if(err){ reject(err); }
                    let pluginConfig = JSON.parse(data);
                    let path = pluginConfig.namespace;
                    let prefix = pluginConfig.namespace.replace("/","_");

                    for(let panelKey in pluginConfig.panels){
                        let panel = pluginConfig.panels[panelKey];
                        result += "Vue.component('"+prefix+"_"+panel.name+"', require('./../../../plugins/"+path+"/resources/views/panels/"+panel.path+"'));\n";
                        //console.log(result);
                    }

                    setTimeout(function(){
                        resolveThis(true);
                    },3000);
                });
            });

            promises.push(promise);
        });

        // when all ajax request are done
        Promise.all(promises).then((promises) => {
            resolve(result);
        });
    });

    getData.then(response => {
        if(fs.writeFile('./resources/assets/js/plugins-panels.js', response)){
            return true;
        }
    });

    return false;
}

/**
 * Watch Plugins' config.json for changes
 */
function watchPluginsConfig(){
    var pluginsList = [];
    fs.readdir('./plugins', (err, authors) => {
        for(let k in authors){
            let authorDirectory = './plugins/'+authors[k];
            fs.readdir(authorDirectory, (err, plugins) => {
                for(let pK in plugins){
                    let path = authorDirectory+'/'+plugins[pK]+'/config.json';
                    if(fs.existsSync(path)) {
                        pluginsList.push(path);  // Save plugins List

                        mapPluginRoutes(pluginsList);
                        fs.watch(path, (eventType, filename) => {  // Watch for changes in plugins' config.json
                            if(eventType == 'change'){
                                mapPluginRoutes(pluginsList);
                            }
                        });
                    }
                }
            });
        }
    });
}

// GET plugins mix.js
function compilePluginChanges() {
    if (fs.existsSync('./plugins')) {
        // get all folders (authors) in main plugins folder
        let authors = fs.readdirSync('./plugins');
        authors.map(function (author, key) {
            if (author !== '.DS_Store' && author !== '.keep') {
                // get the list of plugins
                let pluginsList = fs.readdirSync('./plugins/' + author);
                for (let k in pluginsList) {
                    if (fs.existsSync('./plugins/' + author + '/' + pluginsList[k] + '/config.json')) {
                        // get config for each plugin
                        let config = require('./plugins/' + author + '/' + pluginsList[k] + "/config.json");
                        if (config['mix'] !== undefined) {
                            let jsPaths = config['mix'];
                            mix.js(jsPaths['app'], jsPaths['public']);
                        }
                    }
                }
            }
        });
    }
}

// Compress themes css and js files (takes from config of the theme the list of files to be compress)
function compileThemesAssets(){
    if(fs.existsSync('./themes')){
        // get all folders (authors) in main plugins folder
        let themes = fs.readdirSync('./themes');
        themes.map(function(theme, key){
            if (theme !== '.DS_Store' && theme !== '.gitignore' && theme !== '.keep') {
                // get config data from themes config.json file
                const config = require('./themes/' + theme + "/config.json");

                if(config['mix'] !== undefined && config['mix']['sass'] !== undefined){
                    // compress css files
                    let sassFiles = config['mix']['sass'];
                    sassFiles.map(function(sassFile, key){
                        mix.sass('./themes/' + theme + '/assets/scss/' + sassFile, '../themes/' + theme + '/assets/css/').options({
                            processCssUrls: false,
                        });
                    });
                }

                // merge css file in one
                if(config['css'] !== undefined){
                    let tmpCss = [];
                    for(let k in config['css']){
                        // check if file should merge
                        if(config['css'][k]['merge'] !== undefined && config['css'][k]['merge']){
                            let path = './themes/' + theme + '/assets/css/' + config['css'][k]['path'];
                            tmpCss.push(path);
                        }
                    }
                    // if mix name in config is specified
                    if(config['mix'] !== undefined && config['mix']['mergeStyles'] !== undefined){
                        mix.styles(tmpCss, './themes/' + theme + '/assets/css/' + config['mix']['mergeStyles']);
                    }
                }

                // compress js files
                if(config['js'] !== undefined){
                    let tmpJs = [];
                    for(let k in config['js']){
                        // check if file should merge
                        if(config['js'][k]['merge'] !== undefined && config['js'][k]['merge']){
                            tmpJs.push('./themes/' + theme + '/assets/js/' + config['js'][k]['path']);
                        }
                    }

                    if(config['mix'] !== undefined && config['mix']['mergeScripts'] !== undefined){
                        mix.scripts(tmpJs, './themes/' + theme + '/assets/js/' + config['mix']['mergeScripts']);
                    }
                }
            }
        });
    }
}
