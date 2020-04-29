function vote(arg){
    //arg.addEventListener("click", function() {
        let radios = [...document.querySelectorAll("input[type='radio']")];
        radios.map(function(radio) {
            if (radio.checked) {
                let nominee_id = radio.value;
                let nominee_name = radio.getAttribute("data-name");
                let position_name = radio.getAttribute("data-pos");
                let position = radio.getAttribute("data-position-id");
                let student_id = document.querySelector("#student_id").value;
                performRequest(nominee_id, nominee_name, position_name, student_id, position);
            }
        });
    // });
}

function performRequest(nominee_id, nominee_name, position_name, student_id, position) {
    swal(
        {
            title: `Are you sure to vote ${nominee_name} for the post of ${position_name} ?`,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Vote",
            closeOnConfirm: false
        },

        function() {
            const data = {
                nominee_name: nominee_name,
                nominee_id: nominee_id,
                position_name: position_name,
                student_id: student_id,
                position: position
            };

            const options = {
                method: "POST",
                body: JSON.stringify(data),
                headers: {
                    "Content-Type": "application/json"
                }
            };

            fetch("http://localhost/rguvote/handlers/vote.php", options)
                .then(res => res.json())
                .then(function(res) {
                    if (res.status === true) {
                        swal({
                            title: res.message,
                            type: "success"
                        });      
                        document.querySelector("#done").style.display = "block";
                        document.querySelector("#root").style.display = "none";
                    } else if(res.status === false) {
                        swal({
                            title: res.message,
                            type: "warning"
                        });   
                        setTimeOut(function(){
                            window.location.href = "welcome.php";
                        }, 6000)                        
                    }                            
                });
        }
    );
}
