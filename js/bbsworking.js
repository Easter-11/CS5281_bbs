window.onload=function(){
	var allgood = true;
    var findid = document.getElementById('Register');
    var aInput = findid.getElementsByTagName('input');
    var oName = aInput[0];
    var psw = aInput[1];
    var psw2 = aInput[2];
    var email = aInput[3];
    var nime = aInput[4];
    var login = aInput[5];
    oName.ok = false;
    psw.ok = false;
    psw2.ok = false;
    email.ok = false;
    nime.ok = false;
    var aP = findid.getElementsByTagName('p');
    var oName_msg = aP[0];
    var psw_msg = aP[1];
    var psw2_msg = aP[2];
    var email_msg = aP[3];
    var nime_msg = aP[4];

    //用户名验证
   oName.onfocus = function () {
        oName_msg.style.display = "inline";
        oName_msg.innerHTML = '<i class="icon-info"></i>Username must be unique';
    }
    oName.onblur = function () {
        if (this.value == "") {
            oName_msg.innerHTML = '<i class="icon-cross"></i>Cannot be empty';
            oName.ok = false;
        } else {
            oName_msg.innerHTML = '<i class="icon-checkmark"></i>Initial inspection passed';
            oName.ok = true;
        }

    }

    //邮箱验证
    email.onfocus = function () {
        email_msg.style.display = "inline";
        email_msg.innerHTML = '<i class="icon-info"></i>Please enter an available email address';
    }
    email.onblur = function () {
        var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        email_msg.innerHTML = "";
        if (this.value == "") {
            email_msg.innerHTML = '<i class="icon-cross"></i>Cannot be empty';
        } else if (!re.test(this.value)) {
            email_msg.innerHTML = '<i class="icon-cross"></i>Invalid email format';
        } else {
            email_msg.innerHTML = '<i class="icon-checkmark"></i>OK';
            email.ok = true;
        }
    }
    //密码验证
    psw.onfocus = function () {
        psw_msg.style.display = "block";
        psw_msg.innerHTML = '<i class="icon-info"></i>Please enter 6-16 characters';
    }
    psw.onkeyup = function () {
        if (this.value.length > 6) {
            psw2.removeAttribute("disabled");
            psw2_msg.style.display = "inline";
            psw2_msg.innerHTML = '<i class="icon-info"></i>Re-enter the password';
        }
    }
    psw.onblur = function () {
        psw_msg.innerHTML = "";

        if (this.value == "") {
            psw_msg.innerHTML = '<i class="icon-cross"></i>Cannot be empty';
        } 
        else {
            if ((psw2.value)&&this.value != psw2.value) {
                psw_msg.innerHTML = '<i class="icon-cross"></i>The passwords do not match';
                psw.ok = false;
            }
            else if(this.value.length <= 6 || this.value.length > 16) {
                psw_msg.innerHTML = '<i class="icon-cross"></i>Password length should be between 6 and 16 characters';
            } 
            else {
                psw_msg.innerHTML = '<i class="icon-checkmark"></i>OK';
                psw.ok = true;
            }
         }
        

    }
    //确认密码
    psw2.onfocus = function () {
        psw2_msg.innerHTML = '<i class="icon-info"></i>Please confirm the password';
    }
    psw2.onkeyup = function () {
        psw2_msg.innerHTML = "";
    }
    psw2.onblur = function () {
        if (this.value == "") {
            psw2_msg.innerHTML = '<i class="icon-cross"></i>Cannot be empty';
        } else if (this.value != psw.value) {
            psw.value = "";
            psw2.value = "";
            psw2_msg.innerHTML = '<i class="icon-cross"></i>The passwords do not match,please re-enter!!';

        } else {
            psw2_msg.innerHTML = '<i class="icon-checkmark"></i>OK';
            psw2.ok = true;
        }
    }

    //真实名验证
   nime.onfocus = function () {
        nime_msg.style.display = "inline";
        nime_msg.innerHTML = '<i class="icon-info"></i>input your name';
    }
    nime.onblur = function () {
        if (this.value == "") {
            nime_msg.innerHTML = '<i class="icon-cross"></i>Cannot be empty';
            nime.ok = false;
        } else {
            nime_msg.innerHTML = '<i class="icon-checkmark"></i>Welcome';
            nime.ok = true;
        }

    }
       //   提交验证
    login.onclick = function () {
            for (var i = 0; i < 5; i++) {
                if (!aInput[i].ok) {
                    aInput[i].onfocus();
                    aInput[i].value="";
                    return allgood = false;
                }
            }
            return allgood;
        }
}