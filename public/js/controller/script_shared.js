// General attr
const perPage = 5
let currentPage = 0
let lastPage = 1
let loading = true

function getPostComponent (post) {

  return `<div class="post-preview animate__animated animate__lightSpeedInLeft" style="overflow-wrap: break-word">
                      <div class="row">
                          <div class="col-lg-4 col-12 order-lg-2 mb-lg-0 mb-2">
                              <img class="post-thumbnail"
                                   style="border-radius:4px; width: 100%;height: auto; object-fit: cover "
                                   src="` + post.file + `" alt="` + post.short_title + `">
                          </div>
  
                          <div class="col-lg-8 col-12 order-lg-1">
                              <a class="post-content" href="`+ window.location+'post/'+post.slug+`">
                                  <h2 class="post-title">
                                      ` + post.short_title + `
                                  </h2>
                              </a>
                              <p class=" text-justify post-subtitle">
                                  ` + post.short_content + `
                              </p>
                              <p class="post-meta">Posted at ` + post.created_at + `</p>
                          </div>
                      </div>
                  </div>
                  <hr>`
}

async function loadList () {
  //loading
  this.loading = true
  $('#more').show()
  let categoryId = $('.active').attr('name');

  // load data
  await axios.get(location.origin + '/api/blog/posts', {
      params: {
        'sortBy[updated_at]': 'desc',
        'filters[categoryId]': [categoryId],
        'per_page': perPage,
        'page': ++currentPage,
      },
    },
  ).then(function (response) {
    currentPage = response.data.pagination.currentPage == response.data.pagination.totalPages
      ? ++response.data.pagination.currentPage
      : response.data.pagination.currentPage;
    lastPage = response.data.pagination.totalPages;

    let result = '';
    let data = JSON.parse(JSON.stringify(response.data.data));
    if (data.length){
      data.forEach((post) => {
        result += getPostComponent(post);
      })
    }

    $('#post-list').append(result);

    $('#more').removeAttr('style').hide();
    loading = false
  }).catch(function (err) {
    $('#more').removeAttr('style').hide();
    loading = false
  })
}

$(document).ready(function () {

})

// First load data
$(window).on('load', function () {
  loadList();
})

// soll more data
$(window).scroll(function() {
  if (currentPage <= lastPage && currentPage !== 0 && !loading){
    if($(window).scrollTop()+20 >= ($(document).height() - $(window).height())) {
      loading = true;
      loadList();
    }
  }
});
