document.querySelector("#addReviewbtn").addEventListener("click", function(e) {
    e.preventDefault();

    const productId = e.target.dataset.productid;
    const reviewContent = document.querySelector("#review_content").value;

    fetch("ajax/savereview.php", {
        method: "POST",
        body: JSON.stringify({ productId, content: reviewContent }),
        headers: {
            "Content-Type": "application/json",
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            const reviewsList = document.querySelector(".reviews_list");
            const newReview = document.createElement("li");
            newReview.textContent = data.body;
            reviewsList.appendChild(newReview);
            document.querySelector("#review_content").value = "";
        } else {
            alert(data.message);
        }
    })
    .catch(err => console.error("Er is een fout opgetreden:", err));
});