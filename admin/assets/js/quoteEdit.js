document
  .getElementById('quoteForm')
  .addEventListener('submit', function (event) {
    console.log('submit')
    event.preventDefault()

    // Получение данных из формы
    const category = document.querySelector(
      '.form-select[name="category"]'
    ).value

    const form = document.getElementById('quoteForm')
    const quoteId = form.getAttribute('data-quote-id');
    const author = document.querySelector('.form-select[name="author"]').value
    const text = document.querySelector('.textarea').value

    // Отправка данных на сервер
    fetch('http://localhost/admin/quotes/edit', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        quoteId: +quoteId,
        category: +category,
        author: +author,
        text: text,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        // Обработка ответа от сервера, например, обновление интерфейса
        console.log(data)
      })
      .catch((error) => {
        console.error('Error:', error)
      })
  })
