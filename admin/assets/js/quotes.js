const searchInput = document.getElementById('search_input__quotes')
const searchButton = document.getElementById('search__button__quotes')
const authorsContainer = document.querySelector('.quotes-list')

const sourceAuthors = document.querySelectorAll('.quote__text')

const searchInfoContainer = document.querySelector('.search-deascription')
const searchInfoDescription = document.getElementById('descritption-info_text')
const clearSearchButton = document.getElementById('descritption-info__clear')

const clearSearch = () => {
  for (let i = 0; i < sourceAuthors.length; i++) {
    const authorBlock = sourceAuthors[i].closest('.quetes-list__quete')
    if (authorBlock) {
      authorBlock.style.display = 'flex'
    }
  }
  searchInfoContainer.style.display = 'none'
  searchInput.value = ''
}

const search = () => {
  const searchQuery = searchInput.value
  console.log(searchQuery)
  if (searchQuery) {
    for (let i = 0; i < sourceAuthors.length; i++) {
      const title = sourceAuthors[i].textContent
      const authorBlock = sourceAuthors[i].closest('.quetes-list__quete')
      if (title.toLowerCase().includes(searchQuery.toLowerCase())) {
        if (authorBlock) {
          authorBlock.style.display = 'flex'
        }
      } else authorBlock.style.display = 'none'
    }
    searchInfoContainer.style.display = 'flex'
    searchInfoDescription.innerHTML = `Результаты поиска по заросу <b>"${searchQuery}"</b>`
  } else {
    clearSearch()
  }
}



searchButton.addEventListener('click', search)
clearSearchButton.addEventListener('click', clearSearch)

// Логика удаления цитаты

const deleteQuoteFromPage = (id) => {
    console.log(id)
    for (let i = 0; i < sourceAuthors.length; i++) {
      const quoteBlock = sourceAuthors[i].closest('.quetes-list__quete')
      const quoteId = quoteBlock.getAttribute('data-quote-id')
      console.log(quoteId)
      if (quoteId === id) {
          quoteBlock.parentNode.removeChild(quoteBlock);
        break
      }
    }
  }

function deleteQuote(quoteId) {
  // Используйте AJAX или другой метод для отправки запроса на сервер для удаления цитаты по ID
  // Пример использования Fetch API:
  fetch('http://localhost/admin/quote/delete', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ quoteId: +quoteId }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error('Network response was not ok')
      }
      return response.json()
    })
    .then((data) => {
        deleteQuoteFromPage(quoteId)
        alert('Удаление цитаты произошло успешно')
    })
    .catch((error) => {
      console.log(error)
      alert('Произошла ошибка при удалении')
    })
}

const deleteButtons = document.querySelectorAll('.ratting-btn')
deleteButtons.forEach(function (button) {
  button.addEventListener('click', function (e) {
    console.log('click')
    const quoteId = this.getAttribute('data-quote-id')
    const confirmDelete = confirm('Вы уверены, что хотите удалить цитату?')

    if (confirmDelete) {
      // Отправка запроса на удаление цитаты по ID
      deleteQuote(quoteId)
    }
  })
})
