function generate_bar() {
    document.getElementById("bar-code").src= "https://barcode.tec-it.com/barcode.ashx?data=" + document.getElementById("contentbar").value;
}