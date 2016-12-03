function strength(p){ 
     pt=$("#pass-text"); 
     
    var a=0,b=0,c=0,z=0; 
    var pattern = new RegExp(/[0-9]/); 

    for (i=0; i<p.length;i++)
    {
        if (p[i].match(/[A-Z]/g)) {a=1;}
        if (p[i].match(/[0-9]/g)) {b=1;}
        if (p[i].match(/(.*[!,@,#,$,%,^,&,*,?,_,~])/)){c=1;}  
    }
    if(c==1 && a != 1 && b != 1){
        pt.text("Only special characters are not accepted."); 
        return 0; 
    }
    if(p.length < 8){
        pt.text("Very Weak"); 
        return 0; 
    }
    var z = 1, x = a + b + c;
     if(z > x){
        pt.text("Password Should have Special Characters, Numbers and at-least one Capital Letter"); 
        return x; 
    }
    if(x == 1){
        pt.text("Weak"); 
    }
    if(x==2){
        pt.text("Strong")
    }
    else if(x==3){
        pt.text("Very Strong"); 
    }
    return x; 
}

function wid(p){
 if(p==0)return "0%";
 if(p==1)return "33%";
 if(p==2)return "66%";
 if(p==3)return "100%";
}

$(document).ready(function(){
 v=$("#password");
 p=$("#pbar");

 v.bind('keyup',function(){
    p.css('width',wid(strength(v.val())));
 });
});
