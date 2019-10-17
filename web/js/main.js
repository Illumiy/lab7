function CheckIfRight(a,b,id) {
    $.ajax({
        url: 'http://lab7:8080/web/site/testpage',
        data:{ans: a, que: b,id: id},
        type: 'POST',
        success: function(data){
            if (data[0]==true){
                // alert(data[0]);
                 console.log(data);
                // console.log(data[1]);
                document.getElementById("Test"+data[1]).className = "TestRight";
                document.getElementById("Test"+data[1]).removeAttribute("onclick");
                var OtherElements = document.getElementsByClassName("TestUnClick");
                for (let i=0; i<OtherElements.length; i++) {
                    OtherElements[i].removeAttribute("onclick");
                }
            }else{
                // alert(data[0]);
                // console.log(data);
                // console.log(data[1]);
                document.getElementById("Test"+data[1]).className = "TestWrong";
                document.getElementById("Test"+data[1]).removeAttribute("onclick");
                var OtherElements = document.getElementsByClassName("TestUnClick");
                for (let i=0; i<OtherElements.length; i++) {
                    OtherElements[i].removeAttribute("onclick");
                }
            }
        },
        error: function no (data){
            console.log(data);
            alert("SOMETHING WENT WRONG!!!");
        }
    });
}

function Sos(id) {
    $.ajax({
        url: 'http://lab7:8080/web/site/chooseuser',
        data:{id: id},
        type: 'POST',
        success: function(data){
            if (data==false){
                alert('Пользователь не сменён');
            }
                alert('Пользователь сменён');
                console.log(data);
        },
        error: function no (data){
            console.log(data);
            alert("SOMETHING WENT WRONG!!!");
        }
    });
}
