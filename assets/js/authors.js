const searchInput = document.getElementById("search_input_authors");
const searchButton = document.getElementById("search__button__authors");
const authorsContainer = document.querySelector(".authors-container");

const sourceAuthors = document.querySelectorAll(".text__title");

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

searchButton.addEventListener("click", search);
clearSearchButton.addEventListener("click", clearSearch);
