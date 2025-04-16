import logo from '@/Assets/logo-old.webp';
import { Link } from '@inertiajs/react';

export default function ApplicationLogo() {
    return <Link href={route('home')} className="flex flex-col items-center space-x-2 select-none">
        <img
            src={logo}
            alt="Logo"
            className="h-12 w-auto"
        />
        <span className="text-2xl font-bold text-gray-800">League Simulator</span>
    </Link>;
}
