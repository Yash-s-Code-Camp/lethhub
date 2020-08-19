document.querySelector("#t_pass2").addEventListener('keyup', ()=>{
    var pass1  = document.querySelector("#t_pass").value
    var pass2  = document.querySelector("#t_pass2").value

    if(pass1 !== pass2){
        document.querySelector("#err-msg_t").innerHTML = "Password didn't match"
        document.querySelector("#err-msg_t").style.color = "red"
    }
    else{
        document.querySelector("#err-msg_t").innerHTML = ""
        document.querySelector("#err-msg_t").style.color = "green"
    }
})

document.querySelector("#s_pass2").addEventListener('keyup', ()=>{
    var pass1  = document.querySelector("#s_pass").value
    var pass2  = document.querySelector("#s_pass2").value

    if(pass1 !== pass2){
        document.querySelector("#err-msg_s").innerHTML = "Password didn't match"
        document.querySelector("#err-msg_s").style.color = "red"
    }
    else{
        document.querySelector("#err-msg_s").innerHTML = ""
        document.querySelector("#err-msg_s").style.color = "green"
    }
})