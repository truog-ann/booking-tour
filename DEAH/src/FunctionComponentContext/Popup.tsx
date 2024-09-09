import { useState } from 'react';
import Button from 'react-bootstrap/Button';
import Modal from 'react-bootstrap/Modal';
import StatusPayment from './StatusPayment';
import StatusTour from './StatusTour';
import CurrencyFormatter from './CurrencyFormatter';


function Popup({ item }:{item:any}) {
  const [show, setShow] = useState(false);
  const handleClose = () => setShow(false);
  const handleShow = () => setShow(true);
  console.log(item);

  return (
    <>
      <i role='button' className="ri-eye-fill text-primary fs-4 mr-2" onClick={handleShow} />

      <Modal show={show} onHide={handleClose} size='lg'>
        <Modal.Header closeButton>
          <Modal.Title>Chi tiết Đơn Hàng Booking code: ${item.booking_code}</Modal.Title>
        </Modal.Header>
        <Modal.Body>
          <div className="modal-body">

            <div className="row">
              <div className="col-12 row mb-3">
                <div className="col-6">
                  <p>
                    Tên: <strong>{item.user_name}</strong>
                  </p>
                  <p>
                    Email: <strong>{item.email}</strong>
                  </p>
                  <p>
                    Số Điện Thoại: <strong>{item.phone}</strong>
                  </p>
                  <p>
                    Số Người: <strong>{item.people}</strong>
                  </p>
                  <p>
                    Người Lớn: <strong>{item.adults}</strong>
                  </p>
                  <p>
                    Trẻ Em Từ 2-5 Tuổi: <strong>{item.children2To5}</strong>
                  </p>
                  <p>
                    Trẻ Em Từ 6-12 Tuổi: <strong>{item.children6To12}</strong>
                  </p>



                  <p>
                    Total price: <strong><CurrencyFormatter amount={item.total_price} /> vnđ</strong>
                  </p>
                </div>
                <div className="col-6">
                  <p>Status Payment: <StatusPayment status={item.status_payment} /></p>
                  <p>Status Tour: <StatusTour status={item.status_tour} /></p>
                  <div className="d-flex gap-2">
                    <p>
                      Date start: <strong>{item.start}</strong>
                    </p>
                    <p>
                      Date end: <strong>{item.end}</strong>
                    </p>
                  </div>
                </div>
              </div>
              <div className="col-12 row">

                <div className="col-6">
                  <p className="form-label">Tour Name: <strong>{item.tour_name}</strong>
                  </p>
                  <p>
                    Tour price: <strong><CurrencyFormatter amount={item.tour_price} /> vnđ</strong>
                  </p>
                  <p>
                    Tour address: <strong>{item.tour_address}</strong>
                  </p>
                </div>
                <div className="col-6">
                  <p className="form-label">Hotel Name: <strong>{item.hotel_name}</strong>
                  </p>
                  <p>
                    Hotel price: <strong><CurrencyFormatter amount={item.hotel_price} /> vnđ</strong>
                  </p>
                  <p>
                    Hotel address: <strong>{item.hotel_address}</strong>
                  </p>
                </div>

              </div>
            </div>
          </div>


        </Modal.Body>
        <Modal.Footer>
          <Button variant="secondary" onClick={handleClose}>
            Close
          </Button>
        </Modal.Footer>
      </Modal>
    </>
  );
}



               
           

export default Popup;