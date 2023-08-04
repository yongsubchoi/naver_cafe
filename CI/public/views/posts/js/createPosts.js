// 라디오 버튼에 이벤트 리스너 추가
const radioButtons = document.querySelectorAll('input[type="radio"]');
radioButtons.forEach((button) => {
  button.addEventListener("click", handleRadioSelection);
});

function handleRadioSelection(event) {
  const radio = event.target;
  if (!radio.checked) {
    // 라디오 버튼이 이미 선택된 경우, 선택 해제
    radio.checked = false;
  }
}
