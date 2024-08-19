const express = require('express');
const nodemailer = require('nodemailer');
const bodyParser = require('body-parser');

const app = express();
app.use(bodyParser.json());

app.post('/send-email', (req, res) => {
    const { nombre, total } = req.body;

    // Configura Nodemailer
    let transporter = nodemailer.createTransport({
        service: 'Gmail', // Puedes usar otros servicios como Yahoo, Outlook, etc.
        auth: {
            user: 'tuemail@gmail.com', // Reemplaza con tu correo
            pass: 'tucontrasena', // Reemplaza con tu contraseña
        },
    });

    // Configura el correo
    let mailOptions = {
        from: 'tuemail@gmail.com',
        to: 'correo@destinatario.com', // Reemplaza con el correo del destinatario
        subject: 'Confirmación de compra',
        text: `Hola ${nombre},\n\nGracias por tu compra. El total es de ${total}.\n\nSaludos,\nTechSpot`,
    };

    // Envía el correo
    transporter.sendMail(mailOptions, (error, info) => {
        if (error) {
            return res.status(500).send('Error al enviar el correo');
        }
        res.status(200).send('Correo enviado correctamente');
    });
});

app.listen(3000, () => {
    console.log('Server is running on http://localhost:3000');
});

