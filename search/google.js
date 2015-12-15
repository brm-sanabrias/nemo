// run: casperjs --ignore-ssl-errors=true casper.js --search='aguila'
var casper = require("casper").create({
    clientScripts: ["include/jquery.js"],
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
    },
      verbose: true,
    logLevel: "debug"
});

casper.on('remote.message', function(msg) {
    var elem = msg.split(',');
    this.echo(elem.length);
    var j=0;
    for (var i = 0; i < elem.length; i++) {
          casper.thenOpen(elem[i], function() {

                this.capture("pantallazo/img"+j+".png",{
        top: 0,
        left: 0,
        width: 1000,
        height: 1000
    });
            j++;
          })
    }
    /*var j=1;
      for (var i = 0; i < elem.length; i++) {
        this.echo(elem[i]);
        casper.thenOpen(elem[i], function() {
            //this.wait(5000, function() {
        this.echo(i);

                this.capture("pantallazo/img"+i+".png",{
        top: 0,
        left: 0,
        width: 1000,
        height: 1000
    });
                j++;
            //});
        });
        //setTimeout(function(){},20000);
    };*/
    
});
var search = casper.cli.get("search");
casper.start("http://127.0.0.1/", function() {
  this.echo(search);
    casper.thenEvaluate(function (search) {
        jQuery.ajax({
          async: false,
          method: "POST",
          data: { search : search },
          url: 'http://localhost:8080/search/google.php',
          success:function(data){
            console.log(data);
          },
          error:function(data){
            console.log('It doesn’t work that way :');
          }
        });
    },{search:search});

});
casper.run(function() {
    this.exit();
});