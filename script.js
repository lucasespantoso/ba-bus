function pricing() {

    const routePrices = {
        "economic": {
            "bsas-cor": 5500,
            "cor-bsas": 5500,
            "bsas-mar": 3500,
            "mar-bsas": 3500,
        },
        "standard": {
            "bsas-cor": 6500,
            "cor-bsas": 6500,
            "bsas-mar": 4500,
            "mar-bsas": 4500,
        },
        "executive": {
            "bsas-cor": 7000,
            "cor-bsas": 7000,
            "bsas-mar": 5000,
            "mar-bsas": 5000,
        }
    }
    const promotion = {
        "none": 0,
        "student": 80,
        "trainee": 50,
        "junior": 15,
    }

    let route = document.getElementById("route").value
    let category = document.getElementById("category").value
    let quantity = document.getElementById("quantity").value
    let promo = document.getElementById("promotion").value
    let subtotal = routePrices[category][route] * quantity
    let discount = subtotal * promotion[promo] / 100
    let total = subtotal - discount
    let msj = ''
    if (discount !== 0) msj = `<span class="discount">¡Ahorrás $${discount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')}!</span>`

    document.getElementById("price").innerHTML = `$${total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.')}${msj}`;
}

function reset() {
    document.getElementById("price").innerHTML = '$0';
    document.getElementById("promotion").value = 'none';
    document.getElementById("category").value = 'economic';
    document.getElementById("quantity").value = 1;
}

document.getElementById("resume").addEventListener("click", pricing)

document.getElementById("reset").addEventListener("click", reset)

function getCookie(cookieName) {
    let cookie = {};
    document.cookie.split(';').forEach(function (el) {
        let [key, value] = el.split('=');
        cookie[key.trim()] = value;
    })
    return cookie[cookieName];
}


const heart = document.getElementsByClassName("heart");

for (let i = 0; i < heart.length; i++) {
    const idNumber = heart[i].id.match(/\d/)
    if (getCookie(`liked_${idNumber}`) == 1 && heart[i].id === `l_${idNumber}`) {
        heart[i].style.display = "none";
        document.getElementById(`nl_${idNumber}`).style.display = "block";
    }

}

async function saveLike(id) {
    try {
        const formData = new FormData();
        formData.append("id", id);
        const response = await fetch(window.location.href, {
            method: "POST",
            body: formData,
        });

        return await response.text();

    } catch (error) {
        console.error("Error:", error);
    }
}

async function like(id) {
    document.getElementById(id).style.display = 'none';
    document.getElementById('n' + id).style.display = 'block';

    const likes = await saveLike(id);
    document.getElementById('likes_' + id.match(/\d/)).innerHTML = likes;
}

async function nlike(id) {
    document.getElementById(id).style.display = 'none';
    document.getElementById(id.replace('n', '')).style.display = 'block';

    const likes = await saveLike(id);
    document.getElementById('likes_' + id.match(/\d/)).innerHTML = likes;
}

