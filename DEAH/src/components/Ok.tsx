import 'bootstrap/dist/css/bootstrap.min.css';
// import img from '../assets/category_tour/HaNoi.png';
import { useState } from 'react';
import { Link } from 'react-router-dom';
import '../App1.css'

const MyDropdown = () => {
  const img ='https://png.pngtree.com/png-vector/20190307/ourmid/pngtree-vector-edit-profile-icon-png-image_780604.jpg'
  const [Open, setOpen] = useState(false);
  const Menus = [
    { name: 'Profile', link: '/profile' },
    { name: 'ABC', link: '/abc' },
    { name: 'CC', link: '/cc' },
    { name: 'Logout', link: '/logout' }
  ];

  return (
    <div>
      <div className='relative'>
        <img
          onClick={() => setOpen(!Open)}
          src={img}
          alt="img"
          className='h-8 w-8 border-4 object-cover border-gray-400 rounded-full cursor-pointer'
        />
        {Open && (
          <div className='bg-white p-4 w-40 shadow-lg absolute -left-28 mt-2 rounded hi '>
            <ul className='list-none p-0 m-0'>
              {Menus.map((menu) => (
                <li
                  className='text-lg cursor-pointer rounded  hover:bg-green-400'
                  key={menu.name}
                >
                  <Link 
                    to={menu.link} 
                    onClick={() => setOpen(false)}
                    className='block w-full h-full'
                  >
                   <p> {menu.name}</p>
                  </Link>
                </li>
              ))}
            </ul>
          </div>
        )}
      </div>
    </div>
  );
};

export default MyDropdown;
