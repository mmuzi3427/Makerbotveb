document.getElementById("contactForm").addEventListener("submit", function (e) {
  e.preventDefault(); // sahifa qayta yuklanmasin

  // Ma'lumotlarni olish
  const name = document.getElementById("name").value.trim();
  const email = document.getElementById("email").value.trim();
  const message = document.getElementById("message").value.trim();

  // Faqatgina muvaffaqiyatli xabar chiqariladi
  document.getElementById("response").innerText = `Rahmat, ${name}! Murojaatingiz qabul qilindi.`;

  // Formani tozalash
  document.getElementById("contactForm").reset();
});
