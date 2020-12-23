function unfold(){
    var temp=document.getElementsByClassName("dialogMenu")[0];
    temp.style.display=temp.style.display =="block"?"none":"block";
    //document.getElementsByClassName("dialogMenu").visibility="visible";
}
//获取弹窗
function changePassword(){
    var modal = document.getElementById('ChangPasswordDIV');
    modal.style.display="block";
}

function exitSession(){
    var modal = document.getElementById('quit');
    modal.style.display="block";
}