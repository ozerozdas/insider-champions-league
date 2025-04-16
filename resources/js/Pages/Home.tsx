import { Head, Link } from '@inertiajs/react';
import { Button } from "@/Components/ui/button";

export default function Welcome({ appName }: { appName: string }) {
    return (
        <>
            <Head title="Homepage" />

            <div className='flex flex-col items-center justify-center h-screen bg-gray-100'>
                <div className="bg-white p-10 rounded-xl shadow-xl text-center space-y-6 w-full max-w-md">
                    <h1 className="text-3xl font-bold">
                        Welcome to <br />
                        <span>{appName}</span>
                    </h1>
                    <Button className="w-full" asChild>
                        <Link href={"/Simulation"}>
                            Go to Simulation
                        </Link>
                    </Button>
                </div>
            </div >
        </>
    );
}
