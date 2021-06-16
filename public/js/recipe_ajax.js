const Q = document.getElementById('searchbarre')

//recupere valeu input
    let mot = '';
        Q.addEventListener("keyup", ()=>{
        mot = Q.value;
        // recupere url
        const Url = new URL(window.location.href);
console.log(Url.pathname)
        fetch("cooking/search/" + "?" + mot,{
            headers:{
                "x-Requested-with":"XMLHTTPRequest"
            }
        }).then(response=>{
            console.log(response)
        }).catch(e=>alert(e))

    })
