function unfold(){
    var temp=document.getElementsByClassName("dialogMenu")[0];
    if(temp.style.display == "block"){
        temp.style.display = "none";
    }
    else{
        temp.style.display = "block";
    }
    //document.getElementsByClassName("dialogMenu").visibility="visible";
}