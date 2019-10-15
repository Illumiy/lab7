function CheckIfRight($a,$b,$c) {
    $.ajax({
        url: 'http://lab7:8080/web/site/testpage/?test='+$c+'&Question='.$b,
        data:{ans: $a, que: $b,test:$c},
        type: 'POST',
        success: function(data){
                    if (data==true){
                        alert(data);
                    }else{
                        // console.log(ans);
                        // console.log(que);
                        console.log(data);
                        // alert("YOU PICK A WRONG HOUSE FOOL! *You were hit by a bat*")
                    };
            // if ($a == $c[$b]['answer']){
            // }else {
            //     alert(">OwO<")
            // }
        },
        error: function no (){
            alert("SOMETHING WENT WRONG!!!")
        }
    });
}