// run: casperjs --ignore-ssl-errors=true casper.js --search='aguila'
var casper = require("casper").create({
    viewportSize: {
        width: 1024,
        height: 2000
    },
    pageSettings: {
        javascriptEnabled: true,
        loadImages: true,
        loadPlugins: true,
        localToRemoteUrlAccessEnabled: false,
        userAgent: 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.48 Safari/537.36'
    }
});
var url = casper.cli.get("url");
var vector = url.split("/");
var name = vector[2].replace(".", "_").replace(".", "_");
console.log(name);
casper.start(url, function() {
  casper.thenOpen(url, function() {
    this.capture("pantallazo/"+name+".png",{
      top: 0,
      left: 0,
      width: 1000,
      height: 1000
    });
  });

});
casper.run(function() {
    this.exit();
});