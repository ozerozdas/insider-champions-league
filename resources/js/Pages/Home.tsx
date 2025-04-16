import { useState } from 'react';
import { Head, router } from '@inertiajs/react';
import { useToast } from "@/hooks/use-toast";
import { Button } from "@/Components/ui/button";
import { Loader2 } from 'lucide-react';
import Layout from '@/Layouts/Layout';

export default function Welcome({ appName }: { appName: string }) {
    const [loading, setLoading] = useState(false);
    const { toast } = useToast();

    const handleStartSimulation = () => {
        setLoading(true);
        router.post(route('simulation.start'), {}, {
            onSuccess: () => {
                router.get(route('simulation.dashboard'));
            },
            onError: (error) => {
                toast({
                    description: error[0],
                    duration: 3000
                });
            },
            onFinish: () => {
                setLoading(false);
            }
        });
    };

    return (
        <Layout>
            <Head title="Homepage" />

            <div className="bg-white p-10 rounded-xl shadow-xl text-center space-y-6 w-full max-w-md">
                <h1 className="text-3xl font-bold">
                    Welcome to <br />
                    <span>{appName}</span>
                </h1>
                <Button className="w-full" onClick={handleStartSimulation} disabled={loading}>
                    {
                        loading ? (
                            <>
                                <Loader2 className="animate-spin mr-2" />
                                <span>Simulation Starting</span>
                            </>
                        ) : (
                            <>
                                Start Simulation
                            </>
                        )
                    }
                </Button>
            </div>

        </ Layout>
    );
}
