// General attr
const perPage = 2
let currentPage = 0
let loading = false

function stateLoading () {
  debugger
  if (this.loading) {
    $('#more').removeAttr('style').hide()
    this.loading = false
  } else {
    $('#more').show()
    this.loading = true
  }
}

function getPostComponent (post) {

  return `<div class="post-preview" style="overflow-wrap: break-word">
                      <div class="row" style="max-height: 70vm">
                          <div class="col-lg-4 col-12 order-lg-2 mb-lg-0 mb-2">
                              <img class="post-thumbnail"
                                   style="border-radius:4px; width: 100%; height: 100vm;  object-fit: cover "
                                   src="` + post.file + `" alt="` + post.short_title + `">
                          </div>
  
                          <div class="col-lg-8 col-12 order-lg-1">
                              <a class="post-content" href=""
                                  <h2 class="post-title">
                                      ` + post.short_title + `
                                  </h2>
                              </a>
                              <p class="post-subtitle">
                                  ` + post.short_content + `
                              </p>
                              <p class="post-meta">Post at ` + post.created_at + `</p>
                          </div>
                      </div>
                  </div>
                  <hr>`
}

function loadList () {
  this.stateLoading()
  axios.get(location.origin + '/api/posts', {
      params: {
        'sortBy[updated_at]': 'desc',
        'per_page': perPage,
      },
    },
  ).then(function (response) {
    let result = ''
    let data = JSON.parse(JSON.stringify(response.data.data))
    data.forEach((post) => {
      result += getPostComponent(post)
    })

    $('#post-list').append(result)
    stateLoading()
  })
}

$(document).ready(function () {

})
$(window).on('load', function () {
  loadList()
})