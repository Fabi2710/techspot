const nodemailer = require('nodemailer');

async function enviarCorreo(nombre, total) {
    let transporter = nodemailer.createTransport({
        service: 'Gmail', // O el servicio que estés usando
        auth: {
            user: 'tu_email@gmail.com', // Tu email
            pass: 'tu_contraseña', // Tu contraseña
        },
    });

    let info = await transporter.sendMail({
        from: '"TechSpot" <tu_email@gmail.com>',
        to: 'destinatario@example.com', // Email del cliente
        subject: 'Confirmación de Compra',
        text: `Hola ${nombre}, gracias por tu compra en TechSpot. El total de tu compra es ${total}.`,
    });

    console.log('Mensaje enviado: %s', info.messageId);
}

module.exports = enviarCorreo;
