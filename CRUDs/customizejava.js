const cartItemsList = document.getElementById("cartItems");
const totalPriceElement = document.getElementById("totalPrice");

document.querySelectorAll('input[name="item"]').forEach(function (checkbox) {
  checkbox.addEventListener("change", function () {
    updateCart();
  });
});

function updateCart() {
  const selectedItems = document.querySelectorAll('input[name="item"]:checked');
  let total = 0;
  cartItemsList.innerHTML = "";

  selectedItems.forEach(function (item) {
    const itemPrice = parseFloat(item.dataset.price);
    total += itemPrice;

    const li = document.createElement("li");
    li.textContent = `${item.value} - ${itemPrice.toFixed(2)}`;
    cartItemsList.appendChild(li);
  });

  totalPriceElement.textContent = `Total Price: ${total.toFixed(2)}`;
}
