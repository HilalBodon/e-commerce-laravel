
async function fetchProducts() {
    try {
      const cachedProducts = localStorage.getItem('products');
      if (cachedProducts) {
        return JSON.parse(cachedProducts);
      }
  
      const response = await fetch("http://localhost:8000/api/auth/products");
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      const data = await response.json();
      console.log(data);
      
      localStorage.setItem('products', JSON.stringify(data));
      return data;
      
    } catch (error) {
      console.error("Error fetching products:", error);
      return null;
    }
  }



function renderProducts(response) {
    const products = response.products;
    if (!Array.isArray(products)) {
        return;
    }

    const productsList = document.getElementById('products-list');
    productsList.innerHTML = '';

    products.forEach(product => {
        const li = document.createElement('li');
        li.textContent = product.name;
        productsList.appendChild(li);
    });
}



async function init() {
    try {
      const products = await fetchProducts();

      renderProducts(products);

    } catch (error) {
      console.error('Error initializing products:', error);
    }
  }
