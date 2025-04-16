import logo from '@/Assets/logo-old.webp';

export default function ApplicationLogo() {
    return <div className="flex flex-col items-center space-x-2 select-none">
        <img
            src={logo}
            alt="Logo"
            className="h-12 w-auto"
        />
        <span className="text-2xl font-bold text-gray-800">League Simulator</span>
    </div>;
}
