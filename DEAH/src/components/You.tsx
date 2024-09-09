import React, { useState, useEffect } from 'react';

interface UserPickerProps {
    onUserChange: (adults: number, children2To5: number, children6To12: number) => void;
}

const UserPicker: React.FC<UserPickerProps> = ({ onUserChange }) => {
    const [adults, setAdults] = useState(0);
    const [children2To5, setChildren2To5] = useState(0);
    const [children6To12, setChildren6To12] = useState(0);

    
    const totalUsers = adults + children2To5 + children6To12;
    const maxChildren = 2;

    useEffect(() => {
        if (typeof onUserChange === 'function') {
            onUserChange(adults, children2To5, children6To12);
        } else {
            console.error('onUserChange is not a function');
        }
    }, [adults, children2To5, children6To12, onUserChange]);

    const handleAdultsChange = (increment: boolean) => {
        if (increment) {
            if (totalUsers < 20) {
                setAdults(adults + 1);
            }
        } else {
            if (adults > 0) {
                const newAdults = adults - 1;
                setAdults(newAdults);

                if (children2To5 + children6To12 > newAdults * maxChildren) {
                    const maxAllowedChildren = newAdults * maxChildren;
                    const remainingChildren = Math.max(maxAllowedChildren - children2To5, 0);
                    setChildren6To12(Math.min(children6To12, remainingChildren));
                    setChildren2To5(Math.min(children2To5, maxAllowedChildren));
                }
            }
        }
    };

    const handleChildrenChange = (type: '2-5' | '6-12', increment: boolean) => {
        if (adults === 0) return;

        if (type === '2-5') {
            if (increment) {
                if (totalUsers < 20 && children2To5 + children6To12 < adults * maxChildren) {
                    setChildren2To5(children2To5 + 1);
                }
            } else {
                if (children2To5 > 0) {
                    setChildren2To5(children2To5 - 1);
                }
            }
        } else if (type === '6-12') {
            if (increment) {
                if (totalUsers < 20 && children2To5 + children6To12 < adults * maxChildren) {
                    setChildren6To12(children6To12 + 1);
                }
            } else {
                if (children6To12 > 0) {
                    setChildren6To12(children6To12 - 1);
                }
            }
        }
    };

    return (
        <div className="user-category">
            <div className="dropdown-section position-relative user-picker-dropdown">
                <div className="d-flex gap-12 align-items-center">
                    <div className="qty-container">
                        <strong className='mr-2'>Người lớn (Không giảm)
                        </strong>
                        <button
                            className="qty-btn-minus mr-1"
                            type="button"
                            onClick={() => handleAdultsChange(false)}
                            disabled={adults === 0}
                        >
                            <i className="ri-subtract-fill" />
                        </button>
                        <input
                            type="text"
                            name="adults"
                            className="input-qty input-rounded"
                            value={adults}
                            readOnly
                        />
                        <button
                            className="qty-btn-plus ml-1"
                            type="button"
                            onClick={() => handleAdultsChange(true)}
                            disabled={totalUsers >= 20}
                        >
                            <i className="ri-add-fill" />
                        </button>
                    </div>
                </div>
            </div>
            <div className="dropdown-section position-relative user-picker-dropdown">
                <div className="d-flex gap-12 align-items-center">
                    <div className="qty-container">
                        <strong className='mr-4'>Trẻ 6-12 (giảm 20% giá tiền)</strong>
                        <button
                            className="qty-btn-minus mr-1"
                            type="button"
                            onClick={() => handleChildrenChange('6-12', false)}
                            disabled={children6To12 === 0}
                        >
                            <i className="ri-subtract-fill" />
                        </button>
                        <input
                            type="text"
                            name="children6To12"
                            className="input-qty input-rounded"
                            value={children6To12}
                            readOnly
                        />
                        <button
                            className="qty-btn-plus ml-1"
                            type="button"
                            onClick={() => handleChildrenChange('6-12', true)}
                            disabled={totalUsers >= 20 || children2To5 + children6To12 >= adults * maxChildren}
                        >
                            <i className="ri-add-fill" />
                        </button>
                    </div>
                </div>
            </div>

            <div className="dropdown-section position-relative user-picker-dropdown">
                <div className="d-flex gap-12 align-items-center">
                    <div className="qty-container">
                        <strong className='mr-4'>Trẻ 2 - 5 (miễn phí vé)  </strong>
                        <button
                            className="qty-btn-minus mr-1"
                            type="button"
                            onClick={() => handleChildrenChange('2-5', false)}
                            disabled={children2To5 === 0}
                        >
                            <i className="ri-subtract-fill" />
                        </button>
                        <input
                            type="text"
                            name="children2To5"
                            className="input-qty input-rounded"
                            value={children2To5}
                            readOnly
                        />
                        <button
                            className="qty-btn-plus ml-1"
                            type="button"
                            onClick={() => handleChildrenChange('2-5', true)}
                            disabled={totalUsers >= 20 || children2To5 + children6To12 >= adults * maxChildren}
                        >
                            <i className="ri-add-fill" />
                        </button>
                    </div>
                </div>
            </div>

          
        </div>
    );
};

export default UserPicker;