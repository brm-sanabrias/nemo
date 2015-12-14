var marcas = "";
$(function() {
    var $write = $('#search'),
        shift = false,
        capslock = false;

    $('#keyboard li').click(function() {
        //  alert("click")
        var $this = $(this),
            character = $this.html(); // If it's a lowercase letter, nothing happens to this variable
        // alert(character);
        // Shift keys
        if ($this.hasClass('left-shift') || $this.hasClass('right-shift')) {
            $('.letter').toggleClass('uppercase');
            $('.symbol span').toggle();

            shift = (shift === true) ? false : true;
            capslock = false;
            return false;
        }

        // Caps lock
        if ($this.hasClass('capslock')) {
            $('.letter').toggleClass('uppercase');
            capslock = true;
            return false;
        }

        // Delete
        if ($this.hasClass('delete')) {
            var html = $write.val();

            $write.val(html.substr(0, html.length - 1));
            searchBrand($write.val());
            return false;
        }

        // Special characters
        if ($this.hasClass('symbol')) character = $('span:visible', $this).html();
        if ($this.hasClass('space')) character = ' ';
        if ($this.hasClass('tab')) character = "\t";
        if ($this.hasClass('return')) character = "\n";

        // Uppercase letter
        if ($this.hasClass('uppercase')) character = character.toUpperCase();

        // Remove shift once a key is clicked.
        if (shift === true) {
            $('.symbol span').toggle();
            if (capslock === false) $('.letter').toggleClass('uppercase');

            shift = false;
        }

        // Add the character
        $write.val($write.val() + character);
        searchBrand($write.val());
    });
});

function animate(div, x) {
    $('#' + div).show().removeClass().addClass(x + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
        $(this).removeClass();
    });
};

function searchBrand(term) {
    var n = term.length;
    var $resultCont=$('.resultados-marcas');
    if (n >= 3) {
        $resultCont.html('');
        $.each(marcas, function(i, v) {
            //console.log(v)
            var re = new RegExp(term.toLowerCase());
            var name = v.name.toLowerCase();
            if (name.search(re) != -1) {
                // alert(v.picture);
                $resultCont.append('<li><a href="#"><figure><img src="' + v.picture + '" alt="logo-sample" title="logo-sample" class="circle responsive-img z-depth-1"></figure><span class="marca">' + v.name + '</span></a></li>');
                return;
            }
        });
    }else{
        $resultCont.html('');
    }
}
/// funciones cuando el documento este listo
$(document).ready(function() {
    $.ajax({
        url: 'buscar.php',
        dataType: 'json',
        success: function(data) {
            marcas = data;
        },
        type: 'GET'
    });



    $('#search').focusin(function() {
        animate("keyboard_parent", "bounceIn");
    }).focusout(function() {


    });
});