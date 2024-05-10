function showInfo(item) {
  const content = item.querySelector('div')

  if(!content) {
    return
  }

  const tooltipFragment = document.getElementById('tooltip').content.cloneNode(true)
  const tooltip = tooltipFragment.firstElementChild;
  const title = document.createElement('h1')

  title.appendChild(item.querySelector('time').cloneNode(true))

  tooltip.appendChild(title)
  tooltip.appendChild(content.cloneNode(true))

  tooltip.setAttribute('id', 'tooltipModal')

  document.body.appendChild(tooltip)


  showPopup('tooltipModal', true)
}

function showPopup(id, remove = false) {
  const popup = document.getElementById(id)

    if(!popup){
      return;
    }

    function closePopup(event) {
      const closeButton = event.target.closest('.dialog-close')

      if(!closeButton){
        return
      }

      popup.close()
    }

    popup.addEventListener('click', closePopup);

    popup.addEventListener('close', function() {
      popup.removeEventListener('click', closePopup);

      if(remove){
        popup.remove()
      }
    }, {once: true})

    popup.showModal()
}

document.body.addEventListener('click', function(event){
  const dialogButton = event.target.closest('button[aria-haspopup]')

  if(dialogButton){
    showPopup(dialogButton.getAttribute('aria-haspopup'))
    return
  }

  const lineItem = event.target.closest('td')

  if(lineItem){
    showInfo(lineItem)
    return
  }
})
