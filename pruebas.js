const { Resend } = require('resend')
const resend = new Resend('re_g75p2bUg_DX2Q1dd836B83vaq3Qf5iKJ7')
resend.emails.send({
  from: 'onboarding@resend.dev',
  to: 'ayuste2410@gmail.com',
  subject: 'Pruebas',
  html: '<p>Congrats on sending your <strong>first email</strong>!</p>'
})
