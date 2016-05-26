function confdel(item) {
	// Je nach System müssen Umlaute maskiert werden oder nicht
//    answer=confirm(unescape("M%F6chten Sie " + item + " wirklich l%F6schen?"));
    answer=confirm("Möchten Sie " + item + " wirklich löschen?");
    return answer;
}

function photoswipe(items) {
    var pswpElement = document.querySelectorAll('.pswp')[0];

    // items are the pictures from one gallery.
    // as example:
    // var items = [
    //     {
    //         src: "../images/1.jpg",
    //         w: 1920,
    //         h: 1080
    //     },
    //     {
    //         src: "../images/2",
    //         w: 2560,
    //         h: 1600
    //     },
    //     {
    //         src: "../images/3",
    //         w: 1920,
    //         h: 1080
    //     }
    // ];

    // define options (if needed)
    var options = {
        // optionName: 'option value'
        // for example:
        index: 0 // start at first slide
    };

    // Initializes and opens PhotoSwipe
    var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
    gallery.init();
}