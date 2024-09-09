import { useState } from 'react';
import '../App1.css'
const Payment_PT = ({ setPaymentMethod, paymentMethod }:{setPaymentMethod:any,paymentMethod:any}) => {
  const [openIndex, setOpenIndex] = useState(null);
  const Menus = [
    {
      name1: 'Quý khách vui lòng thanh toán tại bất kỳ văn phòng DEAH trên toàn quốc và các chi nhánh tại nước ngoài.',
      name2: `Quý khách chuyển khoản qua ngân hàng sau <br> <br>

       Ngân hàng Techcombank <br>
       Tên tài khoản: Trần Minh Thắng <br>
        Số tài khoản: 1903 634394 2015 <br>
                <hr>`,
      link: '/abc',
      name3: 'HÌNH THỨC THANH TOÁN BẰNG THẺ ATM/ INTERNET BANKING DEAH chấp nhận thanh toán bằng thẻ ATM qua cổng thanh toán VNPay Hãy đảm bảo Quý khách đang sử dụng thẻ ATM do ngân hàng trong nước phát hành và đã được kích hoạt chức năng thanh toán trực tuyến. '
    },
  ];

  const handleToggle = (index: any) => {
    setOpenIndex(openIndex === index ? null : index);
  };

  const handleRadioChange = (event: any) => {
    setPaymentMethod(event.target.value);
  }

  return (
    <div className='row w-100'>
      <div className="tour-include-exclude m-0 mb-30 radius-6">
        <div className="include-exclude-point">
          <div className="checkbox-group">
            <div className=' open' onClick={() => handleToggle(0)}>
              <div className='d-flex'>
                <input name='payment_method' type="radio" value='VPGD' checked={paymentMethod == 'VPGD'} onChange={handleRadioChange} />
                <label className='bg-white h-9 rounded shadow justify-content-center'>
                  Thanh toán tại văn phòng giao dịch
                </label>
              </div>
              {openIndex === 0 && (
                <div>
                  <ul className='limited-width'>
                    {Menus.map((menu, index) => (
                      <li key={index}>
                        <p className='fs-6'>{menu.name1}</p>

                      </li>
                    ))}
                  </ul>
                </div>
              )}
            </div>
            <div className=' open' onClick={() => handleToggle(1)}>
              <div className='d-flex'>
                <input name='payment_method' type="radio" value='CKNH' checked={paymentMethod == 'CKNH'} onChange={handleRadioChange} />
                <label className='bg-white h-9 rounded shadow justify-content-center'>
                  Chuyển khoản ngân hàng
                </label>
              </div>
              {openIndex === 1 && (
                <div className="menu-info">
                  <ul className='limited-width'>
                    {Menus.map((menu, index) => (
                      <li className='' key={index}>

                        <div className='fs-6' dangerouslySetInnerHTML={{ __html: menu.name2 }} />

                      </li>
                    ))}
                  </ul>
                </div>
              )}
            </div>
            <div className=' open' onClick={() => handleToggle(2)}>
              <div className='d-flex'>
                <input name='payment_method' type="radio" value='VNPAY' checked={paymentMethod == 'VNPAY'} onChange={handleRadioChange} />
                <label className='bg-white h-9 rounded shadow justify-content-center'>
                  Thanh toán VNPay
                </label>
              </div>
              {openIndex === 2 && (
                <div className="menu-info">
                  <ul className='limited-width'>
                    {Menus.map((menu, index) => (
                      <li key={index}>
                        {/* <a href={menu.link}></a> */}
                        <p className='fs-6'>{menu.name3}</p>
                      </li>
                    ))}
                  </ul>
                </div>
              )}
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Payment_PT;
