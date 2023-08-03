const cartItemsList = document.getElementById("cartItems");
const totalPriceElement = document.getElementById("totalPrice");

document.querySelectorAll('input[name="selectedMeal[]"]').forEach(function (checkbox) {
  checkbox.addEventListener("change", function () {
    updateCart();
  });
});

function updateCart() {
  const selectedItems = Array.from(document.querySelectorAll('input[name="selectedMeal[]"]:checked'));
  let total = 0;
  cartItemsList.innerHTML = "";

  selectedItems.forEach(function (item) {
    const row = item.parentNode.parentNode; // Get the table row containing the selected item
    const mealName = row.querySelector('td:nth-child(2)').textContent; // Get the meal name from the second column
    const itemPrice = parseFloat(row.querySelector('td:nth-child(3)').textContent); // Get the price from the third column
    total += itemPrice;

    const li = document.createElement("li");
    li.textContent = `${mealName} - ${itemPrice.toFixed(2)}`;
    cartItemsList.appendChild(li);
  });

  totalPriceElement.textContent = `Total Price: ${total.toFixed(2)}`;
}

function submitOrder() {
  const selectedItems = Array.from(document.querySelectorAll('input[name="selectedMeal[]"]:checked')).map(item => item.value);
  const totalPrice = parseFloat(totalPriceElement.textContent.split(":")[1].trim());

  // Create a data object to send to the server
  const data = {
    selectedItems: selectedItems,
    totalPrice: totalPrice
  };

  // Replace the URL below with the correct path to save_order.php
  const url = "save_order.php";

  // Send the data to the server using an AJAX request
  const xhr = new XMLHttpRequest();
  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        console.log(xhr.responseText); // You can handle the server response here
        alert("Order submitted successfully!"); // Show a success message
        // Clear the shopping cart and update the display
        document.querySelectorAll('input[name="selectedMeal[]"]:checked').forEach(checkbox => checkbox.checked = false);
        updateCart();
      } else {
        console.error("Error submitting order: " + xhr.status);
        alert("Error submitting order. Please try again later."); // Show an error message
      }
    }
  };
  xhr.send(JSON.stringify(data));
}
