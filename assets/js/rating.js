const searchInput = document.getElementById("search_input_rating");
const searchButton = document.getElementById("search__button__rating");
const quotesContainer = document.querySelector(".quetes-rating__list");

const sourceQuotes = document.querySelectorAll(".quetes-list__quete");

const searchInfoContainer = document.querySelector(".search-deascription");
const searchInfoDescription = document.getElementById("descritption-info_text");
const clearSearchButton = document.getElementById("descritption-info__clear");

const quotesButtons = document.querySelectorAll(".ratting-btn");

const inputSelect = document.getElementById("number-select");

const clearSearch = () => {
  quotesContainer.innerHTML = "";
  searchInput.value = "";
  for (node of sourceQuotes) {
    quotesContainer.appendChild(node);
  }
  searchInfoContainer.style.display = "none";
};

const incrementRating = (id) => {
  return async () => {
    await fetch("http://localhost/addRating/", {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ id: id }),
    })
      .then((response) => {
        if (response.ok) {
          // PUT-запрос выполнен успешно
          console.log("PUT-запрос выполнен успешно");
        } else {
          // Обработка ошибки, если не удалось выполнить PUT-запрос
          console.error("Произошла ошибка при выполнении запроса");
        }
      })
      .catch((error) => {
        // Обработка ошибок сети или других исключений
        console.error("Произошла ошибка", error);
      });
  };
};

const search = () => {
  quotesContainer.innerHTML = "";
  const searchQuery = searchInput.value;
  console.log(searchQuery);
  if (searchQuery) {
    for (node of sourceQuotes) {
      if (node.textContent.toLowerCase().includes(searchQuery.toLowerCase())) {
        quotesContainer.appendChild(node);
      }
    }
    searchInfoContainer.style.display = "flex";
    searchInfoDescription.innerHTML = `Результаты поиска по заросу <b>"${searchQuery}"</b>`;
  } else {
    clearSearch();
  }
};

searchButton.addEventListener("click", search);
clearSearchButton.addEventListener("click", clearSearch);
inputSelect.addEventListener("change", (e) => {
  const selectedValue = e.target.value;

  const url = window.location.href.split('/');
  url[url.length-1] = selectedValue
  const newUrl = url.join('/')

  window.location.href = newUrl;
});

// Назначение событий для кнопок рейтинга

for (node of quotesButtons) {
  const id = +node.id.split("-")[1];
  node.addEventListener("click", incrementRating(id));
}

window.addEventListener("load", () => {
  const urlParams = new URLSearchParams(window.location.search);

  // Получаем значение параметра "q"
  const route = window.location.href.split('/');
  const qValue = +route[route.length-1];
  if (qValue) {
    inputSelect.value = qValue;
  } else {
    inputSelect.value = 5;
  }
});
