

const StatusPayment = ({status}:{status:any}) => {
  let alertClass = 'badge bg-';
  let statusinf = "";

  switch (status) {
    case 0:
      statusinf = 'Chưa Thanh Toán';
      alertClass += 'warning ';
      break;
    case 1:
      statusinf = 'Đã thanh toán';
      alertClass += 'success';
      break;
    case 2:
      statusinf = 'Đã Hủy';
      alertClass += 'danger';
      break;
    case 3:
      statusinf = 'Đợi hoàn tiền';
      alertClass += 'info';
      break;
    default:
      statusinf = '';
      alertClass = '';
  }

  return (
    <div className={alertClass} role="alert" >
      {statusinf}
    </div>
  );
};


export default StatusPayment
