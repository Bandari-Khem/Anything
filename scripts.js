const rooms = [
    {
        id: 1,
        title: "Room 1",
        price: "$500/month",
        image: "https://via.placeholder.com/300x200"
    },
    {
        id: 2,
        title: "Room 2",
        price: "$600/month",
        image: "https://via.placeholder.com/300x200"
    },
    {
        id: 3,
        title: "Room 3",
        price: "$700/month",
        image: "https://via.placeholder.com/300x200"
    }
];

// Populate the room listings
const roomList = document.querySelector('.rooms-container');
rooms.forEach(room => {
    const roomCard = document.createElement('div');
    roomCard.classList.add('room-card');
    roomCard.innerHTML = `
        <img src="${room.image}" alt="${room.title}">
        <h2>${room.title}</h2>
        <p>Price: ${room.price}</p>
    `;
    roomList.appendChild(roomCard);
});