// run: casperjs --ignore-ssl-errors=true casper.js --search='aguila'
var casper = require("casper").create({
    viewportSize: {
        width: 500,
        height: 500
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
//console.log(url+' - url');
//var lo =url.length;
//console.log(lo+' - lo');
var vector = url.split("/");//substring(11, lo);//
//console.log(vector + ' -vector');
var name = vector[2];//.replace(".", "_").replace(".", "_");
//console.log(name);
casper.start(url, function() {
  casper.thenOpen(url, function() {
    this.capture("/home/ubuntu/workspace/publication/search/pantallazo/"+name+".png",{
      top: 0,
      left: 0,
      width: 250,
      height: 250
    });
  });

});
casper.run(function() {
    this.exit();
});