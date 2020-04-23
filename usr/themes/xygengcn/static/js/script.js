function navOpen() {
    var el = document.querySelector("#nav-menu-drawer");
    el.classList.remove("slideOut");
    el.classList.add("slideIn");
}

function navClose() {
    var el = document.querySelector("#nav-menu-drawer");
    el.classList.remove("slideIn");
    el.classList.add("slideOut");
}

function showIn() {
    var dom = document.querySelector('#searchBar');
    dom.classList.remove("showOut");
    dom.classList.add("showIn");
};

function mshowIn() {
    navClose();
    showIn();
};

function showOut() {
    var dom = document.querySelector('#searchBar');
    dom.classList.remove("showIn");
    dom.classList.add("showOut");
};

function showQRcode(id, url) {
    let qrcode = new QRCode(document.getElementById(id), {
        width: 200,
        height: 200
    });
    qrcode.makeCode(url);
}

function switchNight(that) {
    let body = document.body;
    if (body.className.indexOf('night') === -1) {
        body.classList.add("night");
        that.innerHTML = '<i class="icon icon-sun">&#xf185;</i>';
    } else {
        body.classList.remove("night");
        that.innerHTML = '<i class="icon icon-moon">&#xf186;</i>';
    }
}