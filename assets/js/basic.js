function put_comma(str){
    str = String(str);
    return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, "$1,");
}

function rm_comma(str){
    str = String(str);
    return str.split(',').join('');
}