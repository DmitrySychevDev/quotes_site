const searchInput = document.getElementById("search_input_authors");
const searchButton = document.getElementById("search__button__authors");
const authorsContainer = document.querySelector(".authors-container");

const sourceAuthors = document.querySelectorAll(".author__name");

const searchInfoContainer = document.querySelector(".search-deascription");
const searchInfoDescription = document.getElementById("descritption-info_text");
const clearSearchButton = document.getElementById("descritption-info__clear");

const clearSearch = () => {

  for (let i = 0; i < sourceAuthors.length; i++) {
    const authorBlock = sourceAuthors[i].closest(".author-block");
    if (authorBlock) {
      authorBlock.style.display = "flex";
    }
  }
  searchInfoContainer.style.display = "none";
  searchInput.value = "";
};

const search = () => {
  const searchQuery = searchInput.value;

  if (searchQuery) {
    for (let i = 0; i < sourceAuthors.length; i++) {
      const title = sourceAuthors[i].textContent;
      const authorBlock = sourceAuthors[i].closest(".author-block");
      if (title.toLowerCase().includes(searchQuery.toLowerCase())) {
        if (authorBlock) {
          authorBlock.style.display = "flex";
        }
      } else authorBlock.style.display = "none";
    }
    searchInfoContainer.style.display = "flex";
    searchInfoDescription.innerHTML = `Результаты поиска по заросу <b>"${searchQuery}"</b>`;
  } else {
    clearSearch();
  }
};

if(searchButton && clearSearchButton){
searchButton.addEventListener("click", search);
clearSearchButton.addEventListener("click", clearSearch);
}

// Логика удаления цитаты

const deleteAuthorFromPage = (id) => {
    for (let i = 0; i < sourceAuthors.length; i++) {
      const authorBlock = sourceAuthors[i].closest('.author-block')
      const quoteId = authorBlock.getAttribute('data-author-id')
      if (quoteId === id) {
        authorBlock.parentNode.removeChild(authorBlock);
        break
      }
    }
  }

function deleteQuote(authorId) {
  fetch('http://localhost/admin/author/delete', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ authorId: +authorId }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error('Network response was not ok')
      }
      return response.json()
    })
    .then((data) => {
        deleteAuthorFromPage(authorId)
        alert(data.message)
    })
    .catch((error) => {
      console.log(error)
      alert(error.message)
    })
}

const deleteButtons = document.querySelectorAll('.ratting-btn')
deleteButtons.forEach(function (button) {
  button.addEventListener('click', function (e) {
    console.log('click')
    const authorId = this.getAttribute('data-author-id')
    const confirmDelete = confirm('Вы уверены, что хотите удалить автора ? Это приведет к удалению всех его цитат!')

    if (confirmDelete) {
      // Отправка запроса на удаление цитаты по ID
      deleteQuote(authorId)
    }
  })
})

function addAuthor(event) {
    console.log(event)
    event.preventDefault(); // Предотвращаем стандартное поведение формы

    // Получаем форму
    const form = document.getElementById('authorForm');

    // Создаем объект FormData для удобства работы с формой и файлами
    const formData = new FormData(form);

    // Отправляем данные формы на сервер
    fetch('http://localhost/admin/authors/add', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Обработка ответа от сервера, например, обновление интерфейса
        alert(data.message)
    })
    .catch(error => {
      alert(error.message)
    });
}

document.getElementById('authorForm').addEventListener('submit',addAuthor)