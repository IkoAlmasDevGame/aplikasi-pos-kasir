function startTime() {
    var day = ["minggu", "senin", "selasa", "rabu", "kamis", "jumat", "sabtu"];
    var today = new Date();
    var h = today.getHours();
    var tahun = today.getFullYear();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('text').innerHTML =
        "&copy Aplikasi Pos Kasir " + tahun + "<br>" + day[today.getDay()] + ", " + h + " : " + m +
        " : " + s;
    var t = setTimeout(startTime, 500);
}

function checkTime(i) {
    if (i < 10) {
        i = "0" + i
    }; // add zero in front of numbers < 10
    return i;
}