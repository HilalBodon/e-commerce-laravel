
// async function fetchCategories() {
//     try {
//       const cachedCategories = localStorage.getItem('categories');
//       if (cachedCategories) {
//         return JSON.parse(cachedCategories);
//       }
  
//       const response = await fetch("http://localhost:8000/api/auth/categories");
//       if (!response.ok) {
//         throw new Error("Network response was not ok");
//       }
//       const data = await response.json();
  
//       localStorage.setItem('categories', JSON.stringify(data));
//       return data;

//     } catch (error) {
//       console.error("Error fetching categories:", error);
//       return null;
//     }
//   }

  
// function renderCategories(categories) {
//     console.log('renderCategories() called');

//       if (categories === null || categories === undefined) {
//         return;
//     }

//     const categoriesList = document.getElementById('categories-list');
//     categoriesList.innerHTML = '';

//     categories.forEach(category => {
//         const li = document.createElement('li');
//         li.textContent = category.name;
//         categoriesList.appendChild(li);
//     });
// }

// // async function init() {
// //     try {
// //       const categories = await fetchCategories();
// //       renderCategories(categories);
// //       console.log('hello');
// //     } catch (error) {
// //       console.error('Error initializing categories:', error);
// //     }
// //   }



// async function addCategoryToDatabase(categoryName) {
//     try {
//         const response = await fetch("http://localhost:8000/api/auth/categories", {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json'
//             },
//             body: JSON.stringify({
//                 name: categoryName
//             })
//         });

//         const data = await response.json();
//         return data;

//     } catch (error) {
//         console.error("Error adding category:", error);
//         return null;
//     }
// }

// async function init() {
//     console.log('init() called');

//     try {
//         const categories = await fetchCategories();
//         renderCategories(categories);

//         const addCategoryButton = document.getElementById('add-category-button');
//         addCategoryButton.addEventListener('click', async (event) => {
//             event.preventDefault();
//             const newCategoryInput = document.getElementById('new-category');
//             const newCategoryName = newCategoryInput.value.trim();
// console.log(newCategoryName);
//             if (newCategoryName === '') {
//                 alert('Please enter a category name.');
//                 return;
//             }

//             const newCategory = await addCategoryToDatabase(newCategoryName);
//             if (newCategory) {
//                 // Clear input field and refresh the categories list
//                 // newCategoryInput.value = '';
//                 const updatedCategories = await fetchCategories();
//                 renderCategories(updatedCategories);
//             }
//             console.log(newCategoryName);

//         });

//     } catch (error) {
//         console.error('Error initializing categories:', error);
//     }
//     console.log('hello1');

// }
// console.log('hello2');

// init();



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
    console.log('renderCategories() called');
    const categoriesList = document.getElementById('categories-list');
    categoriesList.innerHTML = '';

    if (categories === null || categories.length === 0) {
        const li = document.createElement('li');
        li.textContent = 'No categories found.';
        categoriesList.appendChild(li);
    } else {
        categories.forEach(category => {
            const li = document.createElement('li');
            li.textContent = category.name;
            categoriesList.appendChild(li);
        });
    }
}

async function addCategoryToDatabase(categoryName) {
    try {
        const response = await fetch("http://localhost:8000/api/auth/categories", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                name: categoryName
            })
        });

        const data = await response.json();
        return data;
    } catch (error) {
        console.error("Error adding category:", error);
        return null;
    }
}

async function init() {
    console.log('init() called');

    try {
        const categories = await fetchCategories();
        renderCategories(categories);

        const addCategoryButton = document.getElementById('add-category-button');
        addCategoryButton.addEventListener('click', async (event) => {
            event.preventDefault();
            const newCategoryInput = document.getElementById('new-category');
            const newCategoryName = newCategoryInput.value.trim();

            if (newCategoryName === '') {
                alert('Please enter a category name.');
                return;
            }

            const newCategory = await addCategoryToDatabase(newCategoryName);
            if (newCategory) {
                newCategoryInput.value = '';
                const updatedCategories = await fetchCategories();
                renderCategories(updatedCategories);
            }
        });

    } catch (error) {
        console.error('Error initializing categories:', error);
    }
    console.log('hello1');
}

console.log('hello2');

init();

