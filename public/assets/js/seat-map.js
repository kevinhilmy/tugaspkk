const seatMapEl = document.getElementById('seatMap');
if (seatMapEl) {
  const booked = JSON.parse(seatMapEl.dataset.booked || '[]');
  const selectedSeatEl = document.getElementById('selectedSeat');
  const hiddenSeatInput = document.getElementById('seatNumber');
  let activeSeat = null;

  for (let row = 1; row <= 6; row += 1) {
    ['A', 'B', 'C', 'D'].forEach((col) => {
      const seatCode = `${row}${col}`;
      const seat = document.createElement('button');
      seat.type = 'button';
      seat.textContent = seatCode;
      seat.className = 'seat';

      if (booked.includes(seatCode)) {
        seat.classList.add('booked');
      }

      seat.addEventListener('click', () => {
        if (seat.classList.contains('booked')) return;
        if (activeSeat) activeSeat.classList.remove('selected');
        seat.classList.add('selected');
        activeSeat = seat;
        selectedSeatEl.textContent = seatCode;
        hiddenSeatInput.value = seatCode;
      });

      seatMapEl.appendChild(seat);
    });
  }
}
