for (const elem of document.querySelectorAll(".copy")) {
	elem.addEventListener("click", e => {
	  const ta = document.createElement("textarea");
	  ta.innerText = e.target.innerText;
	  document.body.appendChild(ta);
	  ta.select();
	  document.execCommand("copy");
	  document.body.removeChild(ta);
	  alert('Skopirované')
	});
  }
