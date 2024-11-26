document.querySelector("#addReviewbtn").addEventListener("click", function(event) {
    event.preventDefault();

    let productId = this.dataset.productid;
    let content = document.querySelector("#review_content").value;
    
    let formData = new FormData();
    formData.append('content', content);
    formData.append('productId', productId);

    fetch("ajax/savereview.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(result =>{
        let newReview = document.createElement("li");
        newReview.innerHTML = result.body;
        document
            .querySelector(".reviews_list")
            .appendChild(newReview);

        document.querySelector("#review_content").value = "";
    })
    .catch(error => {
        console.error('Error:', error);
    });
    

});