module.exports = function(app, fs, lodash){
    app.get('/config', function(req, res, next) {
        let config = res.locals.config;
        let content = JSON.parse(fs.readFileSync(config.filepath).toString())
        res.json(content);
    });

    app.post('/validated/:library?/:method?', function(req, res, next) {
        let config = res.locals.config;
        if (!req.params.library || req.params.library.match(/vm/i)|| req.params.library.match(/../i)|| req.params.library.match(/%2f/i)|| req.params.library.match(/%2F/i)|| req.params.library.match(/\//i)) req.params.library = "json-schema"
        if (!req.params.method) req.params.method = "validate"

        let json_library = require(req.params.library)
        let valid = json_library[req.params.method](req.body)
        if (!valid) {
            res.send("validator failed");
            return
        }
        let p;
        if (config.path) {
            p = config.path;
        } else if (config.filepath) {
            p = config.filepath;
        } else {
            p = "config.json"
        }
        let content = fs.readFileSync(p).toString()
        try {
            content = JSON.parse(content)
            if (lodash.isEqual(req.body, content))
                res.json(content)
            else
                res.send({ "validator": valid, "content" : content, "log": "wrong content"})
        } catch {
            res.send({ "validator": valid, "content" : content})
        }
    })
}