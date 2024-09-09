
import Header from '../components/Header'
import Footer from '../components/Footer'
import { useNavigate } from 'react-router-dom'
import { useForm } from 'react-hook-form'
import { toast} from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';

type Input = {
  name: string,
  email: string,
  image: string,
  password: number,
  date_of_birth:Date,
  PasswordConfirm: number
}
const Register = () => {
  const navigate = useNavigate()
  const { register, handleSubmit, formState: { errors }, watch } = useForm<Input>()

  const onSubmit = (data: Input) => {
    console.log(data);
    const { name, password, email } = data;
    // Check if there are any validation errors
    if (Object.keys(errors).length === 0) {
      fetch(`${import.meta.env.VITE_BACKEND_URL}/api/client/user/signup`, {
        method: "POST",
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ name, email, password })
      })
        .then(async (resData) => {
          console.log(resData);
          if (resData.ok) {
            navigate('/login')
          
            toast.success('Chúc mừng bạn đã đăng ký thành công');
          } else {
            alert('errors')
            const message = await resData.json()
            return Promise.reject(message)
          }
        })
        .catch(err => {
          alert('lỗi' + err)
        })
    } else {
      alert('Vui lòng điền đầy đủ thông tin và đúng định dạng.')
    }
  }
  return (
    <div>
      <div>
        <Header status={undefined} />
        <main>
          {/* Breadcrumbs S t a r t */}
          <section className="breadcrumbs-area breadcrumb-bg">
            <div className="container">
              <h1 className="title wow fadeInUp" data-wow-delay="0.0s">Đăng ký</h1>
              <div className="breadcrumb-text">
                <nav aria-label="breadcrumb" className="breadcrumb-nav wow fadeInUp" data-wow-delay="0.1s">
                  <ul className="breadcrumb listing">
                    <li className="breadcrumb-item single-list"><a href="index" className="single">Trang chủ</a></li>
                    <li className="breadcrumb-item single-list" aria-current="page"><a href="javascript:void(0)" className="single active">Đăng ký</a></li>
                  </ul>
                </nav>
              </div>
            </div>
          </section>
          {/*/ End-of Breadcrumbs*/}
          {/* Login area S t a r t  */}
          <div className="login-area section-padding">
            <div className="container">
              <div className="row justify-content-center">-
                <div className="col-xl-5 col-lg-6 col-md-8 col-sm-10">
                  <div className="login-card">
                    {/* Logo */}
                    <div className="logo mb-40">
                      <a href="index" className="mb-30 d-block">
                        <img src={`${import.meta.env.VITE_BASE_URL}/assets/images/logo/LOGO-DEAH2-Photoroom.png`} alt="logo" className="changeLogo" width={250}/>
                      </a>
                    </div>
                    {/* Form */}
                    <form onSubmit={handleSubmit(onSubmit)} action="#" method="POST">
                      <div className="contact-form mb-24">
                        <label className="contact-label">Tên </label>
                        <input className="form-control contact-input" type="text" placeholder="Enter Your Tên" {...register("name",
                          {
                            required: " Không được để trống name",
                            minLength: {
                              value: 2,
                              message: "Nhập ít nhất 2 ký tự "
                            }
                          }
                        )} />
                        {errors.name && <span style={{ color: "red" }}>{errors.name?.message}</span>}
                      </div>
                      {/* <div className="contact-form mb-24">
                        <label className="contact-label">Ngày sinh </label>
                        <input className="form-control contact-input" type="date" placeholder="Enter Your Tên" {...register("date_of_birth",
                          {
                            required: " Ngày sinh không được để trống",
                            minLength: {
                              value: 2,
                              message: "Nhập ít nhất 2 ký tự "
                            }
                          }
                        )} />
                        {errors.name && <span style={{ color: "red" }}>{errors.name?.message}</span>}
                      </div> */}
                      <div className="contact-form mb-24">
                        <label className="contact-label">Email </label>
                        <input className="form-control contact-input" type="email" placeholder="Email" {...register("email",
                          {
                            required: "không được để trống email",
                            pattern: {
                              value: /^\S+@\S+\.\S+$/,
                              message: "Không đúng định dạng email"
                            }
                          }
                        )} />
                        {errors.email && <span style={{ color: "red" }}>{errors.email?.message}</span>}
                      </div>

                      {/* Password */}
                      <div className="position-relative contact-form mb-24">
                        <label className="contact-label">Nhập mật khẩu </label>
                        <input type="password" className="form-control contact-input password-input" id="txtPasswordLogin" placeholder="Enter Password" {...register("password",
                          {
                            required: "Không được để trống password",
                            minLength: {
                              value: 6,
                              message: "không được nhỏ hơn 6 ký tự"
                            }
                          })} />
                        {errors.password && <span style={{ color: "red" }}>{errors.password?.message}</span>}

                        <i className="toggle-password ri-eye-line" />
                      </div>
                      {/* Password */}
                      <div className="position-relative contact-form mb-24">
                        <label className="contact-label">Xác nhận mật khẩu</label>
                        <input type="password" className="form-control contact-input password-input" id="txtPasswordLogin2" placeholder="Confirm Password" {...register("PasswordConfirm",
                          {
                            required: "Nhập lại thông tin mật khẩu",
                            validate: (value) => {
                              if (value != watch('password')) {
                                return "Không trùng mật khẩu"
                              }
                            }
                          })} />
                        {errors.PasswordConfirm && <span style={{ color: "red" }}>{errors.PasswordConfirm?.message}</span>}

                        <i className="toggle-password ri-eye-line" />
                      </div>
                      <button className="btn-primary-fill justify-content-center w-100 d-flex justify-content-center gap-6" type='submit'>Đăng ký</button>

                    </form>
                    <div className="login-footer mb-20">
                      <div className="create-account">
                        <p>
                          Bạn đã có tài khoản?
                          <a href="/login">
                            <span className="text-primary"> Đăng Nhập</span>
                          </a>
                        </p>
                      </div>
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
          </div>
          {/*/ End-of Login */}
        </main>
        {/* Footer S t a r t */}
        <Footer />
        <div className="progressParent" id="back-top">
          <svg className="backCircle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
          </svg>
        </div>
        <div className="search-overlay" />
      </div>

    </div>
  )
}

export default Register


