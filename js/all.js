function singlePage(img,ten,gia,max,id){
    const spimg=document.getElementById("spimg");
    const spten=document.getElementById("spten");
    const spprice=document.getElementById("spprice");
    const spmax=document.getElementById("spmax");
    const spid=document.getElementById("spid");
    const singlePage=document.getElementById("singlePage");

    spimg.src=img;
    spten.innerHTML=ten;
    spprice.innerHTML=gia.toString()+" VNĐ";
    spmax.max=max;
    spmax.value=1;
    spid.value=id;
    singlePage.style.display="block";
}

function createParameter(value){
    if(value != null)  return `"${value}"`;
    return null;
}

function handleMinRangerInput(value) {
    value = Math.min(value, parseInt(document.getElementById("maxRanger").value) - 1);
    let rangeValue = (value / parseInt(document.getElementById("minRanger").max)) * 100;
    var children = document.getElementById("slider-distance").childNodes[1].childNodes;
    children[1].style.width = rangeValue + '%';
    children[5].style.left = rangeValue + '%';
    children[7].style.left = rangeValue + '%';
    children[11].style.left = rangeValue + '%';
    children[11].childNodes[1].innerHTML = value;
}

function handleMaxRangerInput(value) {
    value = Math.max(value, parseInt(document.getElementById("minRanger").value) - (-1));
    let rangeValue = (value / parseInt(document.getElementById("maxRanger").max)) * 100;
    var children = document.getElementById("slider-distance").childNodes[1].childNodes;
    children[3].style.width = (100 - rangeValue) + '%';
    children[5].style.right = (100 - rangeValue) + '%';
    children[9].style.left = rangeValue + '%';
    children[13].style.left = rangeValue + '%';
    children[13].childNodes[1].innerHTML = value;
}
