const validateToken = require('../../middlewares/validateTokenRoutes')
const router = require('express').Router()

router.get('/', validateToken, (req, res) => {
  res.json({
    error: null,
    data: {
      title: 'mi ruta protegida',
      user: req.user
    }
  })
})

module.exports = router
