
async function fetchCategories() {
    try {
      const cachedCategories = localStorage.getItem('categories');
      if (cachedCategories) {
        return JSON.parse(cachedCategories);
      }
  
      const response = await fetch("http://localhost:8000/api/auth/categories");
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      const data = await response.json();
  
      localStorage.setItem('categories', JSON.stringify(data));
      return data;

    } catch (error) {
      console.error("Error fetching categories:", error);
      return null;
    }
  }

  
function renderCategories(categories) {
      if (categories === null || categories === undefined) {
        return;
    }

    const categoriesList = document.getElementById('categories-list');
    categoriesList.innerHTML = '';

    categories.forEach(category => {
        const li = document.createElement('li');
        li.textContent = category.name;
        categoriesList.appendChild(li);
    });
}

async function init() {
    try {
      const categories = await fetchCategories();
      renderCategories(categories);
      console.log('hello');
    } catch (error) {
      console.error('Error initializing categories:', error);
    }
  }
