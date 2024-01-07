const categoriesNodes = document.querySelectorAll(".quetes-list__quete");

const deleteCategoryFromPage = (id) => {
  console.log(id)
  for (let i = 0; i < categoriesNodes.length; i++) {
    const categoryBlock = categoriesNodes[i].closest('.quetes-list__quete')
    const categoryId = categoriesNodes[i].getAttribute('data-category-id')
    if (categoryId === id) {
        categoryBlock.parentNode.removeChild(categoryBlock)
        break
    }
  }
}

function deleteCategory(categoryId) {
  // Используйте AJAX или другой метод для отправки запроса на сервер для удаления цитаты по ID
  // Пример использования Fetch API:
  fetch('http://localhost/admin/categories/delete', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({ categoryId: +categoryId }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error('Network response was not ok')
      }
      return response.json()
    })
    .then((data) => {
      deleteCategoryFromPage(categoryId)
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
    const categoryId = this.getAttribute('data-category-id')
    const confirmDelete = confirm(
      'Вы уверены, что хотите удалить категорю? Это приведет к удалению всех цитат этой категории!'
    )

    if (confirmDelete) {
      // Отправка запроса на удаление цитаты по ID
      deleteCategory(categoryId)
    }
  })
})